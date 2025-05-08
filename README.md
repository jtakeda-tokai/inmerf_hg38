# InMeRF (hg38)
## Abstract
The Individual Meta Random Forest (InMeRF) is a tool to predict the pathogenicity of nonsynonymous SNVs (nsSNVs) using 150 independent models that were individually generated for all possible amino acid (AA) substitutions. This version is using 34 rank scores in dbNSFP v4.0a as feature values.
## Materials and Methods
1. A total of 72,556 pathogenic nsSNVs were extracted from the Human Gene Mutation Database (HGMD) Pro 2015.2 [CLASS = DM (disease-causing mutation)] included in dbNSFP v4.0a.
2. A total of 166,161 common nsSNV candidates were extracted from dbNSFP v4.0a based on dbSNP build 151 with at least one minor allelic frequency (MAF) of 1000Gp3_AF, UK10K_AF, ExAC_AF, gnomAD_exomes_AF and gnomAD_genomes_AF is > 0.001. We then filtered 162,918 common nsSNVs by removing nsSNVs included in HGMD and in dbNSFP v4.0a with “clinvar_clnsig = Pathogenic or Likely_pathogenic”.
3. Each nsSNV was classified into one of 150 different nonsynonymous AA substitutions. The pathogenic nsSNVs were sorted in ascending order of MAF, and the common nsSNVs were sorted in descending order of MAF. The same numbers of pathogenic and common nsSNVs were extracted for each AA substitution for random forest (RF) modeling.
4. Among 37 tools in dbNSFP v4.0a, nsSNV coverages of 3 tools were very low in either pathogenic or common nsSNVs. Therefore, rank scores of the remaining 34 tools in dbNSFP v4.0a were used as feature values (Table 1). To make RF models, nsSNVs that lacked one or more of 34 rank scores in dbNSFP v4.0a were excluded. Then, pathogenic and common nsSNVs were discriminated by using a machine learning library, scikit-learn, on Python version 3.7. Finally, a total of 150 RF models were generated (Figure 1).

Table 1. 37 tools in dbNSFP v4.0a and their nsSNV coverages in all, pathogenic and common nsSNVs.
    <table border="1" cellspacing="0">
      <tr>
        <th>Tool</th>
        <th>Type</th>
        <th>Rate in all nsSNVs<br>(77,195,651)</th>
        <th>Rate in pathogenic nsSNVs<br>(72,556)</th>
        <th>Rate in common nsSNVs<br>(162,918)</th>
        <th>Feature values used for RF models</th>
      </tr>
      <tr>
        <td>SIFT</td>
        <td rowspan="28">prediction</td>
        <td>92.65</td>
        <td>97.31</td>
        <td>89.62</td>
        <td>O</td>
      </tr>
      <tr>
        <td>SIFT4G</td>
        <td>95.63</td>
        <td>98.12</td>
        <td>93.46</td>
        <td>O</td>
      </tr>
      <tr>
        <td>Polyphen2_HDIV</td>
        <td>87.13</td>
        <td>92.14</td>
        <td>80.88</td>
        <td>O</td>
      </tr>
      <tr>
        <td>Polyphen2_HVAR</td>
        <td>87.13</td>
        <td>92.14</td>
        <td>80.88</td>
        <td>O</td>
      </tr>
      <tr>
        <td>LRT</td>
        <td>82.39</td>
        <td>93.93</td>
        <td>72.45</td>
        <td>O</td>
      </tr>
      <tr>
        <td>MutationTaster</td>
        <td>96.89</td>
        <td>99.94</td>
        <td>95.72</td>
        <td>O</td>
      </tr>
      <tr>
        <td>MutationAssessor</td>
        <td>82.45</td>
        <td>89.32</td>
        <td>76.07</td>
        <td>O</td>
      </tr>
      <tr>
        <td>FATHMM</td>
        <td>88.83</td>
        <td>98.27</td>
        <td>87.35</td>
        <td>O</td>
      </tr>
      <tr>
        <td>PROVEAN</td>
        <td>93.15</td>
        <td>98.29</td>
        <td>90.39</td>
        <td>O</td>
      </tr>
      <tr>
        <td>VEST4</td>
        <td>97.31</td>
        <td>99.35</td>
        <td>95.72</td>
        <td>O</td>
      </tr>
      <tr>
        <td>MetaSVM</td>
        <td>95.82</td>
        <td>99.40</td>
        <td>94.08</td>
        <td>O</td>
      </tr>
      <tr>
        <td>MetaLR</td>
        <td>95.82</td>
        <td>99.40</td>
        <td>94.08</td>
        <td>O</td>
      </tr>
      <tr>
        <td>M-CAP</td>
        <td>95.90</td>
        <td>97.39</td>
        <td><font color="red">37.24</font></td>
        <td>X</td>
      </tr>
      <tr>
        <td>REVEL</td>
        <td>95.82</td>
        <td>99.40</td>
        <td>94.08</td>
        <td>O</td>
      </tr>
      <tr>
        <td>MutPred</td>
        <td>90.22</td>
        <td>81.09</td>
        <td><font color="red">6.21</font></td>
        <td>X</td>
      </tr>
      <tr>
        <td>MVP</td>
        <td>97.80</td>
        <td>99.12</td>
        <td>73.85</td>
        <td>O</td>
      </tr>
      <tr>
        <td>MPC</td>
        <td>83.00</td>
        <td>91.76</td>
        <td>75.79</td>
        <td>O</td>
      </tr>
      <tr>
        <td>PrimateAI</td>
        <td>89.88</td>
        <td>96.72</td>
        <td>85.13</td>
        <td>O</td>
      </tr>
      <tr>
        <td>DEOGEN2</td>
        <td>91.13</td>
        <td>94.52</td>
        <td>86.73</td>
        <td>O</td>
      </tr>
      <tr>
        <td>CADD</td>
        <td>99.97</td>
        <td>100.00</td>
        <td>100.00</td>
        <td>O</td>
      </tr>
      <tr>
        <td>DANN</td>
        <td>99.41</td>
        <td>100.00</td>
        <td>100.00</td>
        <td>O</td>
      </tr>
      <tr>
        <td>fathmm-MKL</td>
        <td>99.41</td>
        <td>100.00</td>
        <td>100.00</td>
        <td>O</td>
      </tr>
      <tr>
        <td>fathmm-XF</td>
        <td>92.62</td>
        <td>86.76</td>
        <td>92.20</td>
        <td>O</td>
      </tr>
      <tr>
        <td>Eigen</td>
        <td>92.49</td>
        <td>87.62</td>
        <td>92.02</td>
        <td>O</td>
      </tr>
      <tr>
        <td>Eigen-PC</td>
        <td>92.49</td>
        <td>87.62</td>
        <td>92.02</td>
        <td>O</td>
      </tr>
      <tr>
        <td>GenoCanyon</td>
        <td>99.41</td>
        <td>100.00</td>
        <td>100.00</td>
        <td>O</td>
      </tr>
      <tr>
        <td>integrated_fitCons</td>
        <td>95.45</td>
        <td>87.68</td>
        <td>97.44</td>
        <td>O</td>
      </tr>
      <tr>
        <td>LINSIGHT</td>
        <td><font color="red">2.04</font></td>
        <td><font color="red">0.07</font></td>
        <td><font color="red">3.52</font></td>
        <td>X</td>
      </tr>
      <tr>
        <td>GERP++</td>
        <td rowspan="9">conservation</td>
        <td>98.95</td>
        <td>99.98</td>
        <td>98.51</td>
        <td>O</td>
      </tr>
      <tr>
        <td>phyloP100way_vertebrate</td>
        <td>99.99</td>
        <td>100.00</td>
        <td>99.97</td>
        <td>O</td>
      </tr>
      <tr>
        <td>phyloP30way_mammalian</td>
        <td>99.96</td>
        <td>100.00</td>
        <td>99.94</td>
        <td>O</td>
      </tr>
      <tr>
        <td>phyloP17way_primate</td>
        <td>99.92</td>
        <td>100.00</td>
        <td>99.90</td>
        <td>O</td>
      </tr>
      <tr>
        <td>phastCons100way_vertebrate</td>
        <td>99.99</td>
        <td>100.00</td>
        <td>99.97</td>
        <td>O</td>
      </tr>
      <tr>
        <td>phastCons30way_mammalian</td>
        <td>99.96</td>
        <td>100.00</td>
        <td>99.94</td>
        <td>O</td>
      </tr>
      <tr>
        <td>phastCons17way_primate</td>
        <td>99.92</td>
        <td>100.00</td>
        <td>99.90</td>
        <td>O</td>
      </tr>
      <tr>
        <td>SiPhy</td>
        <td>97.98</td>
        <td>99.88</td>
        <td>97.09</td>
        <td>O</td>
      </tr>
      <tr>
        <td>bStatistic</td>
        <td>98.24</td>
        <td>98.93</td>
        <td>98.02</td>
        <td>O</td>
      </tr>
    </table><br>

![Figure 1](/scripts/Figure-1.png)\
Figure 1. Overview of strategies for InMeRF and InMeRF-CADD. In InMeRF-CADD, pathogenic and common nsSNVs in CADD instead of HGMD and dbSNP were used to compare with other tools under the same conditions.
## Publication
Please cite: Jun-ichi Takeda, Kentaro Nanatsue, Ryosuke Yamagishi, Mikako Ito, Nobuhiko Haga, Hiromi Hirata, Tomoo Ogi, and Kinji Ohno. “InMeRF: Prediction of pathogenicity of missense variants by individual modeling for each amino acid substitution” NAR Genom Bioinform. 2020 May 26;2(2):lqaa038 ([PMID: 33543123](https://pubmed.ncbi.nlm.nih.gov/33543123/)).
## Related tools
[InMeRF (hg19)](https://github.com/jtakeda-tokai/inmerf_hg19.git)\
[IntSplice2 (hg19/hg38)](https://github.com/jtakeda-tokai/intsplice2.git)\
[FexSplice (hg19/hg38)](https://github.com/jtakeda-tokai/fexsplice.git)
